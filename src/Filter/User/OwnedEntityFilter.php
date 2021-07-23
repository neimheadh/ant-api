<?php


namespace App\Filter\User;


use ApiPlatform\Core\Exception\PropertyNotFoundException;
use App\Entity\User\User;
use App\Exception\Filter\FilterAnnotationReaderNotSetException;
use App\Model\User\OwnedEntityInterface;
use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Query\Filter\SQLFilter;
use ReflectionException;
use ReflectionProperty;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Owned entity filter.
 *
 * @package App\Filter\User
 */
class OwnedEntityFilter extends SQLFilter
{
    /**
     * Annotation reader.
     *
     * @var Reader
     */
    private $reader;

    /**
     * Authenticated user.
     *
     * @var User
     */
    private $user;

    /**
     * Get the owner id field name.
     *
     * @param ClassMetadata $target The target entity metadata.
     *
     * @throws ReflectionException The owner property cannot be found.
     *
     * @return string
     */
    private function _getOwnerIdField(ClassMetadata $target): string
    {
        $join = $this->_getOwnerJoinColumnAnnotation($target);

        return $join && $join->name ? $join->name : 'owner_id';
    }

    /**
     * Get the entity owner property.
     *
     * @param ClassMetadata $target The target entity class metadata.
     *
     * @throws ReflectionException The owner property cannot be found.
     *
     * @return JoinColumn|null
     */
    private function _getOwnerJoinColumnAnnotation(ClassMetadata $target): ?JoinColumn
    {
        $property = $target->getReflectionClass()->getProperty('owner');
        $reader = $this->_getReader();

        return $reader->getPropertyAnnotation($property, JoinColumn::class);
    }

    /**
     * Get the annotation reader.
     *
     * @throws FilterAnnotationReaderNotSetException The reader is not set.
     *
     * @return Reader
     */
    private function _getReader(): Reader
    {
        if (!$this->reader) {
            throw new FilterAnnotationReaderNotSetException(self::class, 'setAnnotationReader');
        }

        return $this->reader;
    }

    /**
     * Get if the target entity is a owned entity.
     *
     * @param ClassMetadata $target The target entity class metadata.
     *
     * @return bool
     */
    private function _isOwnedEntity(ClassMetadata $target): bool
    {
        return $target->getReflectionClass()->implementsInterface(OwnedEntityInterface::class);
    }

    /**
     * Get if the entity owner is nullable.
     *
     * @param ClassMetadata $target The entity target class metadata.
     *
     * @throws ReflectionException The owner property cannot be found.
     *
     * @return bool
     */
    private function _isOwnerNullable(ClassMetadata $target): bool
    {
        $join = $this->_getOwnerJoinColumnAnnotation($target);

        return !$join || $join->nullable;
    }

    /**
     * {@inheritDoc}
     *
     * @throws ReflectionException The owner property cannot be found.
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        if (!$this->_isOwnedEntity($targetEntity)) {
            return '';
        }

        $ownerIdField = $this->_getOwnerIdField($targetEntity);
        $nullable = $this->_isOwnerNullable($targetEntity);
        $field = "$targetTableAlias.$ownerIdField";
        $filters = [];

        if (!$nullable && !$this->user) {
            throw new AccessDeniedHttpException('Authentication needed.');
        }

        if ($this->user) {
            $filters[] = $field . ' = ' . $this->user->getId();
        }

        if ($nullable) {
            $filters[] = $field . ' IS NULL';
        }

        return implode(' OR ', $filters);
    }

    /**
     * Set the annotation reader.
     *
     * @param Reader $reader The annotation user.
     *
     * @return $this
     */
    public function setAnnotationReader(Reader $reader): self
    {
        $this->reader = $reader;

        return $this;
    }

    /**
     * Set the authenticated user.
     *
     * @param User|null $user The authenticated user.
     *
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}