// Place third party dependencies in the lib folder
//
// Configure loading modules from the lib directory,
// except 'app' ones, 
requirejs.config({
    "baseUrl": "js/libs",
    "paths": {
      "app": "../app"
    },
    "shim": {
        "jquery": ["jquery-1.9.1"],
        "jquery.migrate": ["jquery-migrate.1.2.1.js"],
        "jquery.ui": ["jquery-ui-1.10.3/ui/jquery-ui.js"],
        "favico": ["favico"],
        "spin": ["spin.min"],
        "cookie": ["jquery.cookie"],
        "form": ["jquery.form"],
		
    }
});

// Load the main app module to start the app
requirejs(["app/main"]);