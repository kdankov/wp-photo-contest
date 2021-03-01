"use strict";

let gulp = require("gulp"),
	autoprefixer = require("gulp-autoprefixer"),
	sass = require("gulp-sass"),
	sassLint = require("gulp-sass-lint"),
	sourcemaps = require("gulp-sourcemaps"),
	plumber = require("gulp-plumber"),
	cp = require("child_process");;

let browserSync = require('browser-sync').create();

/**
* Unify all scripts to work with source and destination paths.
* For more custom paths, please add them in this object
*/
const paths = {
	source: {
		scripts: "assets/src/scripts/",
		sass: "assets/src/sass/",
		images: "assets/src/images/",
	},
	destination: {
		scripts: "assets/dist/scripts/",
		css: "assets/dist/css/",
		images: "assets/dist/images/",
	}
};

gulp.task("sass", function() {
	return gulp
	.src(paths.source.sass + "**/*.scss")
	.pipe(sourcemaps.init())
	.pipe(sass().on("error", sass.logError))
	.pipe(autoprefixer())
	.pipe(sourcemaps.write('./'))
	.pipe(gulp.dest(paths.destination.css))
	.pipe(browserSync.stream({ match: '**/*.css' }))
	;
});

// The files to be watched for minifying. If more dev js files are added this
// will have to be updated.
gulp.task("watch", function() {

	browserSync.init({
		proxy: {
			target: 'http://photos.givingforce.online'
		}
	});

	gulp.watch(paths.source.sass + "**/*.scss", gulp.series("sass"));
	gulp.watch("**/*.php").on('change', browserSync.reload);
});

// Will delete .git files so that you can use it on your own repository
gulp.task("reset", function() {
	del(".git");
	del(".DS_Store");

	// @TODO: create a command that will rename all functions and comments
	// to use the one the developer needs.
});

// What will be run with simply writing "$ gulp"
gulp.task("default", 
	gulp.series("sass", "watch")
);
