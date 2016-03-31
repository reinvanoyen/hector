# Some examples

## Select

```php
<?php

Query::select( [ 'field1', 'field2' ] )
	->from( 'table' )
	->where( [ 'field' => 'value', ] )
	->orderBy( [ 'field' => Query::ASC ] )
	->limit( 5 )
;
```

## Update

```php
<?php

Query::update( 'table_name' )
	->set( [ 'field' => 'value', ] )
	->where( [ 'field' => 'value', ] )
	->limit( 5 )
;
```