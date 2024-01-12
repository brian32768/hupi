# docker-hupi

Set up for hupi.org

This project uses Docker Compose to run the components needed by HUPI.org:

* Caddy as the webserver
* PHPFPM as the PHP server

## HTTPS and reverse proxy

2024-01-12 Implemented Cloudflare Zero Trust tunnel. This means
I am now running the cloudflared in a Docker container and it
passes traffic between this server and Cloudflare. Then Cloudflare
handles proxying and HTTPS encryption. (Traffic between Cloudflare
and this server is also encrypted by cloudflared)

Now that I am using Zero Trust, I feel confident that I can put my wiki
on my own server Bellman and free up space and memory on this VPS.

Before cloudflared I was running Varnish/Hitch to do the reverse proxy
and running Let's Encrypt from crontab. I have removed all that.

Before THAT I was using Caddy as a reverse proxy and its built-in Let's Encrypt
and before THAT I was using the jwilder nginx set up.

## Deployment with Docker Compose

It's just

   docker compose build
   docker compose up -d

There are probably a lot of PHP extensions in the Dockerfile
left over from the wiki set up that could be removed.

Watch the cloudflare container's log file! It pings the web server.
If one is down it will stop working.

