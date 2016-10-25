module.exports = {
    // configuration
    entry: "./Modules/Templating/Assets/FrontEnd/index.main.js",
    module: {
        loaders: [{
            test: /\.js$/,
            loaders: ['ng-annotate','babel?presets[]=es2015'],
            exclude: /node_modules/,
        }]
    }
};
