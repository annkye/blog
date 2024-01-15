FROM node:21.5-alpine3.18 AS node-builder

WORKDIR /app

COPY ./package.json ./yarn.lock ./

RUN yarn install && npm rebuild node-sass

COPY ./ ./

RUN npm run build

######################

FROM nginx:1.24-alpine

COPY ./docker/production/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /app

COPY ./public ./public
COPY --from=node-builder /app/public/build ./public/build
