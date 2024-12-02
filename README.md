# KGO

This template should help get you started developing with Vue 3 in Vite.

## Requirements

- install the latest version of NodeJS and npm
- install the latest version of Python
- install and host MariaDB in order for data to be displayed correctly
  - create a database with the schema found in [this](https://docs.google.com/document/d/e/2PACX-1vRkmhOkE8wa2sq14SEWkfKkODw_u5Cc3qqE4BM_eKsW9qvI-an8_UhS_OIWSlZfpOznaqEW42NIh8Hc/pub) document

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur).

## Customize configuration

See [Vite Configuration Reference](https://vite.dev/config/).

# Running the front-end

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```

### Lint with [ESLint](https://eslint.org/)

```sh
npm run lint
```

# Running the backend 

## Project Setup

```
cd server
pip install -r requirements.txt
```

# Run code for backend server

```
cd server
export K_GO_HOST = [IP ADDRESS OF SQL SERVER]
export K_GO_USER = [SQL USERNAME]
export K_GO_PASS = [SQL PASSWORD]
export K_GO_DATA = [NAME OF SQL DATABASE]
export FLASK_APP = index.py
flask run -p 5941
```

