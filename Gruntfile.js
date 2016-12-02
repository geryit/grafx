module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt); // npm install --save-dev load-grunt-tasks
    require('time-grunt')(grunt);
    var mozjpeg = require('imagemin-mozjpeg');
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        mysql: grunt.file.readJSON('mysql.json'),
        timestamp: grunt.template.today('mm-dd-yyyy_HH-MM-ss'),



        watch: {
            options: {
                spawn: false,
                livereload: true
            },
            configFiles: {
                files: [ 'Gruntfile.js' ],
                options: {
                    reload: true //reloads grunt, not chrome
                },
                tasks: [
                    'sass:dev',
                    'concat'
                    // 'copy:css'
                ]
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
                    sourceMap: true,
                    // sourceMapEmbed: true,
                    // sourceMapContents : true,

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
                            'bower_components/angucomplete-alt/angucomplete-alt.js',
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
                    '.sass-cache', '/src', '.tmp', '*.map', '.db', 'mysql.json'],
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
            theme: {
                options: {
                    src: "./",
                    dest: "/home/ubuntu/grafxwp/wp-content/themes/grafx",
                    host: "ubuntu@54.80.56.240",
                    delete: true // Careful this option could cause data loss, read the docs!
                }
            },
            wpcontent: {
                options: {
                    src: "../../",
                    dest: "/home/ubuntu/grafxwp/wp-content/",
                    host: "ubuntu@54.80.56.240",
                    delete: true // Careful this option could cause data loss, read the docs!
                }
            }
        },

        sshexec: {
            dump_remote_db: {
                options: {
                    host: '<%= mysql.remote.host %>',
                    username: '<%= mysql.remote.username %>',
                    agent: process.env.SSH_AUTH_SOCK
                },
                command: [
                    'cd <%= mysql.remote.save_path %>',
                    'mysqldump <%= mysql.remote.dbname %> -u <%= mysql.remote.dbuser %> -p<%= mysql.remote.dbpass %> > remote-<%= timestamp %>.sql'
                ].join(' && ')
            },
            cleanup_remote: {
                options: {
                    host: '<%= mysql.remote.host %>',
                    username: '<%= mysql.remote.username %>',
                    agent: process.env.SSH_AUTH_SOCK
                },
                command: [
                    'cd <%= mysql.remote.save_path %>',
                    'rm local_migrated-<%= timestamp %>.sql'
                ].join(' && ')
            },
            cleanup_remote_dump: {
                options: {
                    host: '<%= mysql.remote.host %>',
                    username: '<%= mysql.remote.username %>',
                    agent: process.env.SSH_AUTH_SOCK
                },
                command: [
                    'cd <%= mysql.remote.save_path %>',
                    'rm remote-<%= timestamp %>.sql'
                ].join(' && ')
            },
            import_migrated_local_dump: {
                options: {
                    host: '<%= mysql.remote.host %>',
                    username: '<%= mysql.remote.username %>',
                    agent: process.env.SSH_AUTH_SOCK
                },
                command: [
                    'cd <%= mysql.remote.save_path %>',
                    'mysql -u <%= mysql.remote.dbuser %> -p<%= mysql.remote.dbpass %> <%= mysql.remote.dbname %> < local_migrated-<%= timestamp %>.sql'
                ].join(' && ')
            },
            targz_remote_wpcontent: {
                options: {
                    host: '<%= mysql.remote.host %>',
                    username: '<%= mysql.remote.username %>',
                    agent: process.env.SSH_AUTH_SOCK
                },
                command: [
                    'cd /home/ubuntu/grafxwp/wp-content',
                    'tar -cvf - plugins uploads | gzip > ~/wpcontent-<%= timestamp %>.tar.gz'
                ].join(' && ')
            },
            remove_remote_wpcontent: {
                options: {
                    host: '<%= mysql.remote.host %>',
                    username: '<%= mysql.remote.username %>',
                    agent: process.env.SSH_AUTH_SOCK
                },
                command: [
                    'cd ~',
                    'rm -rf wpcontent-<%= timestamp %>.tar.gz'
                ].join(' && ')
            }
        },
        exec: {
            wget_remote_dump: {
                command: 'cd <%= mysql.local.dump_dir %> && wget -nv <%= mysql.remote.save_url %>/remote-<%= timestamp %>.sql'
            },
            backup_remote_dump: {
                command: 'cd <%= mysql.local.dump_dir %> && cp remote-<%= timestamp %>.sql remote-backup-<%= timestamp %>.sql'
            },
            import_migrated_remote_dump: {
                command: 'mysql -u <%= mysql.local.dbuser %> <%= mysql.local.dbname %> < <%= mysql.local.dump_dir %>/remote_migrated-<%= timestamp %>.sql'
            },
            cleanup_local: {
                command: 'cd <%= mysql.local.dump_dir %> &&  rm -rf local-<%= timestamp %>.sql local_migrated-<%= timestamp %>.sql'
            },
            cleanup_remotes: {
                command: 'cd <%= mysql.local.dump_dir %> && rm -rf remote-<%= timestamp %>.sql remote_migrated-<%= timestamp %>.sql'
            },
            dump_local_db: {
                command: 'mysqldump -u <%= mysql.local.dbuser %> <%= mysql.local.dbname %> > <%= mysql.local.dump_dir %>/local-<%= timestamp %>.sql'
            },
            scp_local_dump: {
                command: 'scp <%= mysql.local.dump_dir %>/local_migrated-<%= timestamp %>.sql <%= mysql.remote.username %>@<%= mysql.remote.host %>:<%= mysql.remote.save_path %>'
            },
            download_remote_wpcontent: {
                command: 'echo "Downloading..."  && scp -r <%= mysql.remote.username %>@<%= mysql.remote.host %>:~/wpcontent-<%= timestamp %>.tar.gz ~'
            },
            export_and_remove_local_wpcontent: {
                command: 'cd <%= mysql.local.wpcontent_dir %> && tar -zxvf  ~/wpcontent-<%= timestamp %>.tar.gz && rm -rf ~/wpcontent-<%= timestamp %>.tar.gz'
            }
        },
        peach: {
            search_replace_remote_dump: {
                options: {
                    force: true
                },
                src:  '<%= mysql.local.dump_dir %>/remote-<%= timestamp %>.sql',
                dest: '<%= mysql.local.dump_dir %>/remote_migrated-<%= timestamp %>.sql',
                from: '<%= mysql.remote.site_url %>',
                to:   '<%= mysql.local.site_url %>'
            },
            search_replace_local_dump: {
                options: {
                    force: true
                },
                src:  '<%= mysql.local.dump_dir %>/local-<%= timestamp %>.sql',
                dest: '<%= mysql.local.dump_dir %>/local_migrated-<%= timestamp %>.sql',
                from: '<%= mysql.local.site_url %>',
                to:   '<%= mysql.remote.site_url %>'
            }
        }
    });
    grunt.registerTask('default', ['sass:dev', 'concat',
        'newer:imagemin', 'newer:copy']);

    grunt.registerTask('sync_local_db', [
        'sshexec:dump_remote_db',             //dump remote database
        'exec:wget_remote_dump',              //download remote dump
        'exec:backup_remote_dump',
        'sshexec:cleanup_remote_dump',          //delete remote dump
        'peach:search_replace_remote_dump',   //search and replace URLs in database
        'exec:import_migrated_remote_dump',   //import the migrated database
        'exec:cleanup_local'      //delete local database dump files
    ]);

    grunt.registerTask('sync_remote_db', [
        'sshexec:dump_remote_db',             //dump remote database
        'exec:wget_remote_dump',              //download remote dump
        'exec:backup_remote_dump',
        'sshexec:cleanup_remote_dump',          //delete remote dump
        'exec:cleanup_remotes',                 //delete local database dump files
        'exec:dump_local_db',                 //dump local database
        'peach:search_replace_local_dump',    //search and replace URLs in database
        'exec:scp_local_dump',                //upload local dump
        'exec:cleanup_local',                 //delete local database dump files
        'sshexec:import_migrated_local_dump', //import the migrated database
        'sshexec:cleanup_remote'             //delete remote database dump file
    ]);

    grunt.registerTask('download_wpcontent', [
        'sshexec:targz_remote_wpcontent',
        'exec:download_remote_wpcontent',
        'sshexec:remove_remote_wpcontent',
        'exec:export_and_remove_local_wpcontent'
    ]);


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
        'rsync:theme',
        'sass:dev',
        'concat'
    ]);
    grunt.registerTask('full-deploy', [
        'build',
        'rsync:wpcontent',
        'sync_remote_db',
        'sass:dev',
        'concat'
    ]);
};


