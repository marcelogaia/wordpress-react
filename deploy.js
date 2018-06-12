var FtpDeploy = require('ftp-deploy');
var ftpDeploy = new FtpDeploy();
 
var config = {
    user: "marcelogaia7",                   // NOTE that this was username in 1.x 
    // password: "",           // optional, prompted if none given
    host: "ftp.marcelogaia.com.br",
    port: 21,
    localRoot: __dirname + '/build',
    remoteRoot: '/marcelogaia.com.br/',
    include: ['*', '**/*'],      // this would upload everything except dot files
    // include: ['*.php', 'dist/*'],
    exclude: ['dist/**/*.map'],     // e.g. exclude sourcemaps
    deleteRoot: false                // delete existing files at destination before uploading
}
 
// use with promises
ftpDeploy.deploy(config)
    .then(res => console.log('finished'))
    .catch(err => console.log(err))