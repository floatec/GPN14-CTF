#!/bin/bash
echo "127.0.0.1 localhost" > /tmp/hosts
echo "$WIKI_PORT_80_TCP_ADDR intranet.gallery.corp" >> /tmp/hosts
