const fs = require('fs');
const process = require('process');

const pageName = process.argv[2];
const htmlTemplate = `<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no"
    />
    <title>New Page</title>
  </head>

  <body>
    <div id="root">
        <h2>Контент</h2>
    </div>
  </body>
</html>`;

const scssTemplate = `@import "./rootStyles/main.scss";`;

const jsTemplate = `import * as $ from 'jquery';
  import '../scss/${pageName}.scss';
  import header from '../components/header.html';

  $(() => {
    $('#root').prepend(header);
  });`;

const createPage = () => {
  fs.open(`./src/${pageName}.html`, 'w', (err) => {
    if (err) throw err;
    fs.writeFile(`./src/${pageName}.html`, htmlTemplate, (err) => {
      if (err) throw err;
      console.log('Html page created');
    });
  });

  fs.open(`./src/scss/${pageName}.scss`, 'w', (err) => {
    if (err) throw err;
    fs.writeFile(`./src/scss/${pageName}.scss`, scssTemplate, (err) => {
      if (err) throw err;
      console.log('Scss page created');
    });
  });

  fs.open(`./src/js/${pageName}.js`, 'w', (err) => {
    if (err) throw err;
    fs.writeFile(`./src/js/${pageName}.js`, jsTemplate, (err) => {
      if (err) throw err;
      console.log('JS page created');
    });
  });
};

pageName ? createPage() : console.log('Page title is not specified');
