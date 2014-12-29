module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
		
		cssmin: {
  minify: {
    expand: true,
    cwd: 'css/',
    src: ['*.css', '!*.min.css'],
    dest: 'release/css/',
    ext: '.min.css'
  }
}
		});
		    // 3. Where we tell Grunt we plan to use this plug-in.
grunt.loadNpmTasks('grunt-contrib-cssmin');
	
};