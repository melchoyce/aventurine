module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      frontEnd: {
				options: {
					style: 'expanded',
					lineNumbers: true
				},
        src: ['sassy_s/*.scss', '!sassy_s/_*.scss' ],
        dest: 'style.css'
      }
    },
    watch: {
      sass: {
        files: ['sassy_s/*.scss'],
        tasks: ['sass']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['sass']);


};