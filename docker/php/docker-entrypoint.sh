#!/bin/bash

# Create developer user.
id "${UNAME}" &> /dev/null
if [ $? -gt 0 ]; then
  groupadd -o -g "${GID}" "${UNAME}"
  useradd -m -o -u ${UID} -g "${GID}" -s /bin/bash "${UNAME}"
  chown "${UNAME}":"${UNAME}" /home/"${UNAME}" -R
fi

# Generate OAUTH SSL key pair
if [ ! -f "${OAUTH2_PRIVATE_SSL_KEY}" ] || [ ! -f "${OAUTH2_PUBLIC_SSL_KEY}" ]; then
  mkdir -p "$(dirname "${OAUTH2_PRIVATE_SSL_KEY}")" "$(dirname "${OAUTH2_PUBLIC_SSL_KEY}")"
  openssl genrsa -out "${OAUTH2_PRIVATE_SSL_KEY}" 2048
  openssl rsa -in "${OAUTH2_PRIVATE_SSL_KEY}" -pubout -out "${OAUTH2_PUBLIC_SSL_KEY}"
  chown "${UNAME}":"${UNAME}" -R "$(dirname "${OAUTH2_PRIVATE_SSL_KEY}")" "$(dirname "${OAUTH2_PUBLIC_SSL_KEY}")"
fi

# Generate OAUTH client
_OAUTH2_CLIENT=$(sudo -u "${UNAME}" bin/console trikoder:oauth2:list-clients | grep "${OAUTH2_CLIENT_ID}" | wc -l)
if [ "$_OAUTH2_CLIENT" -eq 0 ]; then
  sudo -u "${UNAME}" bin/console trikoder:oauth2:create-client "${OAUTH2_CLIENT_ID}" "${OAUTH2_CLIENT_SECRET}"
fi

# Execute php docker entrypoint
sudo -u "${UNAME}" /bin/bash /usr/local/bin/docker-php-entrypoint $@