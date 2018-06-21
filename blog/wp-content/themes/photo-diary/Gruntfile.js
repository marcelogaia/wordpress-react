module.exports = function(grunt) {

	// Configure main project settings
	grunt.initConfig({


		// Baisc settings about info and plugins
		pkg: grunt.file.readJSON('package.json'),

		// name of plugin (plugin name without the "grunt-contrib-")
		sass: {
			dist: {
				options: {
					sourcemap: 'none'
				},
				files: {
					'style.css' : 'scss/style.scss'
				}
			}
		},
		postcss: {
			options: {
				processors: [
					require('pixrem'),
					require('autoprefixer')
				]
			},
			dist: {
				src: 'style.css'
			}
		},
		clean: {
			options: {
				force: true,
			},
			before: {
				src: ['./photo-diary', '../photo-diary.zip']
			},
			after: {
				src: ['./photo-diary']
			}
		},
		copy: {
            main: {
                files: [
                    { 
                    	expand: true, 
                    	cwd: './', src: ['**', '!node_modules/**', '!.*/**', '!scss/**', 'Gruntfile.js', 'package-lock.json', 'package.json'], 
                    	dest: './photo-diary/' 
                    }
                ],
            },
        },
        zip: {
        	'../photo-diary.zip': ['./photo-diary/**']
        },
		watch: {
			options: {
				livereload: true,
			},
			files: ['*.php', '*/*.php', 'scss/**/*.scss'],
			tasks: ['sass', 'postcss'],
		},



	});

	// load the plugin
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-zip');
	
	// do the task
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('convert', ['sass']);
	grunt.registerTask('build', ['sass', 'postcss', 'clean:before', 'copy', 'zip', 'clean:after']);

};