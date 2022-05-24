const ftp = require('basic-ftp');
require('dotenv').config();

const url = process.env.FTP_HOST.includes('//')
  ? process.env.FTP_HOST.slice(process.env.FTP_HOST.indexOf('//') + 2)
  : process.env.FTP_HOST;

deploy();

async function deploy() {
  const client = new ftp.Client();
  client.ftp.verbose = true;
  try {
    await client.access({
      host: url,
      user: process.env.FTP_USER,
      password: process.env.FTP_PASS
    });
    await client.ensureDir('/public_html/assets/templates');
    await client.clearWorkingDir();
    await client.uploadFromDir('build');
  } catch (err) {
    console.log(err);
  }
  client.close();
}
