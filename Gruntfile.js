module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt); // npm install --save-dev load-grunt-tasks
    require('time-grunt')(grunt);
    var mozjpeg = require('imagemin-mozjpeg');
    grunt.initConfig({
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
                    livereload: false
                }
            },
            css: {
                files: [
                    'assets/css/*.css'
                ]
            },
            js: {
                files: 'src/js/**/*.js',
                tasks: ['newer:concat']
            },
            img: {
                files: 'src/img/**/*.*',
                tasks: ['newer:imagemin']
            },
            fonts: {
                files: 'src/fonts/**/*.*',
                tasks: ['newer:copy:fonts']
            },
            others: {
                files: 'src/{fonts}/**/*.*',
                tasks: ['newer:copy']
            },
            php: {
                options: {
                    livereload: true
                },
                files: '**/*.php'
            }
        },
        clean: {
            assets: ['assets']
        },
        sass: {
            dev: {
                options: {
                    sourceMap: true
                },
                files: {
                    'assets/css/styles.css': 'src/scss/styles.scss'
                }
            },
            dist: {
                files: {
                    'assets/css/styles.css': 'src/scss/styles.scss'
                }
            }
        },
        // uncss: {
        //     dist: {
        //         options: {
        //             ignoreSheets : [/fonts.googleapis/],
        //             csspath      : 'assets/css',
        //             stylesheets  : ['assets/css/styles.css'],
        //             timeout      : 1000,
        //         },
        //         files: [{
        //             nonull: true,
        //
        //             src: [
        //                 'template-*.php',
        //                 'header.php'
        //             ],
        //             dest: 'dist/css/tidy.css'
        //         }]
        //     }
        // },
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
                    cwd: 'assets/css/',
                    src: '{,*/}*.css',
                    dest: 'assets/css/'
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
                            'bower_components/jquery/dist/jquery.slim.js'
                        ],
                        dest: 'assets/js/scripts.min.js'
                    }
                ]
            }

        },
        uglify: {
            dist: {
                files: {
                    'assets/js/main.min.js': ['assets/js/main.min.js']
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
                    dest: 'assets/img/'                  // Destination path prefix
                }]
            }
        },
        copy: {
            // img: {
            //     expand: true,
            //     cwd: 'src/img',
            //     src: ['**'],
            //     dest: 'assets/img'
            // },
            video: {
                expand: true,
                cwd: 'src/video',
                src: ['**'],
                dest: 'assets/video'
            },
            other: {
                expand: true,
                cwd: 'src/other',
                src: ['**'],
                dest: 'assets/other'
            },
            fonts: {
                expand: true,
                cwd: 'src/fonts',
                src: ['**'],
                dest: 'assets/fonts'
            },
            // css: {
            //     expand: true,
            //     cwd: 'assets/css',
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
                    '.sass-cache', '/src', '.tmp'],
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
                    dest: "/var/www/html/wp-content/themes/chm",
                    host: "ubuntu@52.36.145.115",
                    delete: true // Careful this option could cause data loss, read the docs!
                }
            }
        }
    });
    grunt.registerTask('default', ['newer:clean', 'sass:dev', 'newer:concat',
        'newer:imagemin', 'newer:copy']);
    grunt.registerTask('build', [
        // 'clean',
        'sass:dist',
        'newer:postcss',
        'newer:concat',
        'newer:uglify',
        'newer:imagemin',
        'newer:copy'
    ]);
    grunt.registerTask('deploy', [
        'build',
        'rsync',
        'sass:dev'
    ]);
};


