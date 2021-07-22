#!/bin/bash
set -x

# Create developer user.
id "${UNAME}" &> /dev/null
if [ $? -gt 0 ]; then
  groupadd -o -g ${GID} ${UNAME}
  useradd -m -o -u ${UID} -g ${GID} -s /bin/bash ${UNAME}
  chown ${UNAME}:${UNAME} /home/${UNAME} -R
fi

# Execute php docker entrypoint
sudo -u ${UNAME} /bin/bash /usr/local/bin/docker-php-entrypoint $@