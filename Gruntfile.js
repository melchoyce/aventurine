/* jshint node:true */
module.exports = function(grunt) {
	var path = require('path');
	// Load tasks.
	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	// Project configuration.
	grunt.initConfig({
		sass: {
			dist: {
				options: {
					noCache: true,
					sourcemap: true
				},
				expand: true,
				cwd: 'sassy_s/',
				dest: '.',
				ext: '.css',
				src: [ 'style.scss' ]
			}
		},

		watch: {
			colors: {
				files: ['sassy_s/**'],
				tasks: ['sass:dist']
			}
		}
	});

	// Register tasks.

	// Build task.
	grunt.registerTask('build', ['sass:dist']);

	// Default task.
	grunt.registerTask('default', ['build']);

};
