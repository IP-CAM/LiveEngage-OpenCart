/*global module:false*/
var path = require('path');
module.exports = function(grunt) {

    grunt.initConfig({
        watch: {
            opencart: {
                files: ['src/**'],
                tasks: ['copy:updatedocker'],
            }
        },
        copy: {
            updatedocker: {
                files: [
                    {expand: true, cwd: 'src/admin', src: ['**'], dest: 'docker-files/admin'},
                    {expand: true, cwd: 'src/catalog', src: ['**'], dest: 'docker-files/catalog'}
                ]
            }
        },
        zip: {
            'using-router': {
                // `router` receives the path from grunt (e.g. js/main.js)
                // The path it returns is what the file contents are saved as (e.g. all/main.js)
                router: function (filepath) {
                    // Route each file to all/{{filename}}
                    var filename = path.basename(filepath);
                    if (filepath.indexOf("install.xml") === -1) return 'upload/' + filename;
                    return filename;
                },

                // Files will zip to 'main.js' and 'main.css'
                src: ['src/install.xml', 'src/admin', 'src/catalog'],
                dest: 'build/liveengage.ocmod.zip'
            }
        }
    });

    // Load in `grunt-zip`
    grunt.loadNpmTasks('grunt-zip');
    //load watch
    grunt.loadNpmTasks('grunt-contrib-watch');
    //load copy
    grunt.loadNpmTasks('grunt-contrib-copy');

};
