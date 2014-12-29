requirejs.config({
    //By default load any module IDs from js/lib
    baseUrl: 'js/app',
    //except, if the module ID starts with "app",
    //load it from the js/app directory. paths
    //config is relative to the baseUrl, and
    //never includes a ".js" extension since
    //the paths config could be for a directory.
    paths: {
        app: '../'
    }
});

// Start the main app logic.
requirejs(['jquery-1.9.1', 'jquery-migrate.1.2.1', 'jquery-ui', 'favico', 'spin.min', 'jquery.cookie', 'jquery.form', 'tacalert'],
function   ($,jQuery,jQueryUI,favico,spin,cookie,form,tacalert) {
    //jQuery, canvas and the app/sub module are all
    //loaded and can be used here now.
});