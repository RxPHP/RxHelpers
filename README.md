===============
Helper Functions for RxPHP
===============

```PHP
Observable::of(Observable::fromArray([1, 2, 3, 4, 5]))
    ->filter(\Rx\is(Observable::class))
    ->mergeAll()
    ->filter(\Rx\notEqualTo(2))
    ->filter('rx\even')
    ->reduce('rx\add')
    ->map(\Rx\p('rx\mult', 3))
    ->map(\Rx\p('rx\sub', 2))
    ->map(\Rx\p('rx\concatLeft', 'total: '))
    ->compose(\Rx\echoFinally('Test '))
    ->subscribe(\Rx\echoObserver('Test '));


//Test Next value: total: 10
//Test Complete!
//Test Finally! 
```