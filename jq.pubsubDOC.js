// Super-basic example:

function handle(e, a, b, c) {
  // `e` is the event object, you probably don't care about it.
  console.log(a + b + c);
};

$.subscribe("/some/topic", handle);

$.publish("/some/topic", [ "a", "b", "c" ]);
// logs: abc

$.unsubscribe("/some/topic", handle); // Unsubscribe just this handler

// Or:

$.subscribe("/some/topic", function(e, a, b, c) {
  console.log(a + b + c);
});

$.publish("/some/topic", [ "a", "b", "c" ]);
// logs: abc

$.unsubscribe("/some/topic"); // Unsubscribe all handlers for this topic


/*	JSfiddle example:	*/

// Log something, or nothing at all.
function log(msg) {
  $('body').append('<br/>' + (msg || ''));
}

// Create a logging function, for the purpose of this example.
function createLogger(message) {
    // Return a function that logs the passed message argument followed
    // by all published values. In order to do this, the first argument
    // (the jQuery event object) is ignored.
    return function() {
        // Get an array of all but the first argument.
        var values = [].slice.call(arguments, 1);
        // Log message + published values
        log(message + ' (' + values.join(', ') + ')');
    };
};

// Subscribe to the "foo" topic with various jQuery "namespaces".
$.subscribe('foo', createLogger('foo'));
$.subscribe('foo.bar', createLogger('foo.bar'));
$.subscribe('foo.baz', createLogger('foo.baz'));
$.subscribe('foo.bar.baz', createLogger('foo.bar.baz'));

log(); $.publish('foo', 1);
// should output:
// foo (1)
// foo.bar (1)
// foo.baz (1)
// foo.bar.baz (1)

log(); $.publish('foo.bar', [2, 3]);
// should output:
// foo.bar (2, 3)
// foo.bar.baz (2, 3)

log(); $.publish('foo.baz', 4);
// should output:
// foo.baz (4)
// foo.bar.baz (4)

log(); $.publish('foo.bar.baz', [5, 6]);
// should output:
// foo.bar.baz (5, 6)

$.unsubscribe('foo.bar.baz');

log(); $.publish('foo', 7);
// should output:
// foo (7)
// foo.bar (7)
// foo.baz (7)
