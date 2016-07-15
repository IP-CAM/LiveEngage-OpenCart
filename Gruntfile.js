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
        compress: {
            main: {
                options: {
                    archive: 'build/live_engage.ocmod.zip'
                },

                files: [
                    {expand: true, cwd: 'src/', src: ['admin/**'], dest: 'upload/' },
                    {expand: true, cwd: 'src/', src: ['catalog/**'], dest: 'upload/'},
                    {expand: true, cwd: 'src/', src: ['install.xml'], dest: '/'}
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-compress');
    //load watch
    grunt.loadNpmTasks('grunt-contrib-watch');
    //load copy
    grunt.loadNpmTasks('grunt-contrib-copy');

};
