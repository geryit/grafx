module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt); // npm install --save-dev load-grunt-tasks
    require('time-grunt')(grunt);
    var mozjpeg = require('imagemin-mozjpeg');
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            options: {
                spawn: false,
                livereload: true
            },
            configFiles: {
                files: [ 'Gruntfile.js' ],
                options: {
                    reload: true //reloads grunt, not chrome
                }
            },
            sass: {
                files: ['src/**/*.scss'],
                tasks: [
                    'sass:dev'
                    // 'copy:css'
                ],
                options: {
                    spawn: true,
                    livereload: false // no need to turn on livereload
                }
            },
            css: {
                files: [
                    'dist/css/*.css'
                ]
            },
            js: {
                files: 'src/js/**/*.js',
                tasks: ['newer:concat']
            },
            img: {
                files: 'src/img/**/*',
                tasks: ['newer:imagemin']
            },
            fonts: {
                files: 'src/fonts/**/*',
                tasks: ['newer:copy:fonts']
            },
            video: {
                files: 'src/video/**/*',
                tasks: ['newer:copy:video']
            },
            php: {
                options: {
                    livereload: true
                },
                files: '**/*.php'
            }
        },
        clean: {
            dist: ['dist']
        },
        sass: {
            dev: {
                options: {
                    sourceMap: true
                },
                files: {
                    'dist/css/<%= pkg.name %>.css': 'src/scss/<%= pkg.name %>.scss'
                }
            },
            dist: {
                files: {
                    'dist/css/<%= pkg.name %>.css': 'src/scss/<%= pkg.name %>.scss'
                }
            }
        },
        postcss: {
            options: {
                map: false,
                processors: [
                    require('pixrem')(), // add fallbacks for rem units
                    require('autoprefixer')({browsers: 'last 10 versions'}), // add vendor prefixes
                    require('cssnano')({discardComments: {removeAll: true}}) // minify the result
                ]
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: 'dist/css/',
                    src: '{,*/}*.css',
                    dest: 'dist/css/'
                }]
            }
        },
        concat: {
            options: {
                sourceMap: true
            },
            dev: {
                files: [
                    {
                        src: [
                            'bower_components/jquery/dist/jquery.slim.js',
                            'bower_components/angular/angular.js',
                            'bower_components/slick-carousel/slick/slick.js',
                            'node_modules/video.js/dist/video.js',
                            'src/js/<%= pkg.name %>.js'
                        ],
                        dest: 'dist/js/<%= pkg.name %>.min.js'
                    }
                ]
            }

        },
        uglify: {
            dist: {
                files: {
                    'dist/js/<%= pkg.name %>.min.js': ['dist/js/<%= pkg.name %>.min.js']
                }
            }

        },
        imagemin: {                          // Task
            build: {
                options: {                       // Target options
                    optimizationLevel: 3,
                    progressive: true,
                    svgoPlugins: [{removeViewBox: false}],
                    use: [require('imagemin-pngquant')()]
                },// Another target
                files: [{
                    expand: true,                  // Enable dynamic expansion
                    cwd: 'src/img/',                   // Src matches are relative to this path
                    src: ['**/*.{png,jpg,gif,svg}'],   // Actual patterns to match
                    dest: 'dist/img/'                  // Destination path prefix
                }]
            }
        },
        copy: {
            // img: {
            //     expand: true,
            //     cwd: 'src/img',
            //     src: ['**'],
            //     dest: 'dist/img'
            // },
            video: {
                expand: true,
                cwd: 'src/video',
                src: ['**'],
                dest: 'dist/video'
            },
            fonts: {
                expand: true,
                cwd: 'src/fonts',
                src: ['**'],
                dest: 'dist/fonts'
            },
            // css: {
            //     expand: true,
            //     cwd: 'dist/css',
            //     src: ['*.css'],
            //     dest: '.tmp/'
            // }
        },

        rsync: {
            options: {
                args: ["--update -raz --progress --verbose"],
                delete: true,
                exclude: ['.git*', '*.scss', 'node_modules', 'bower_components', '.idea', '*.iml', '.DS_Store',
                    '.editorconfig', '.gitignore', '*.md', 'bower.json', 'package.json', 'npm-debug.log', 'Gruntfile.js',
                    '.sass-cache', '/src', '.tmp', '*.map'],
                recursive: true
            },
            // stage: {
            //     options: {
            //         src: "./",
            //         dest: "/home/geryit/chm.geryit.com/wp-content/themes/chm",
            //         host: "geryit@geryit.com",
            //         delete: true // Careful this option could cause data loss, read the docs!
            //     }
            // },
            production: {
                options: {
                    src: "./",
                    dest: "/home/ubuntu/grafxwp/wp-content/themes/grafx",
                    host: "ubuntu@54.80.56.240",
                    delete: true // Careful this option could cause data loss, read the docs!
                }
            }
        }
    });
    grunt.registerTask('default', ['sass:dev', 'concat',
        'newer:imagemin', 'newer:copy']);
    grunt.registerTask('build', [
        //'clean',
        'sass:dist',
        'newer:postcss',
        'concat',
        'newer:uglify',
        'newer:imagemin',
        'newer:copy'
    ]);
    grunt.registerTask('deploy', [
        'build',
        'rsync',
        'sass:dev',
        'concat'
    ]);
};


