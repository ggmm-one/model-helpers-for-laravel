# Model Helpers for Laravel

A set of helpers for building Laravel apps even faster:

* [CascadeSoftDeletes](cascadesofdeletes) - emulates sql cascade on delete for SoftDelete models
* [HasModelDisplayName](hasmodeldisplaynames) - used by other helpers to figure out the display name
* [HasOrder](hasorder) - creates a default order by scope

## CascadeSoftDeletes

If you have a class like:

```php
class User extends Model
{
    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany('App\Posts');
    }
}
```

You can modify to:

```php
use Ggmm\Model\CascadeSoftDeletes;

class User extends Model
{
    use CascadeSoftDeletes;

    protected $cascadeDelete = ['posts'];

    public function posts()
    {
        return $this->hasMany('App\Posts');
    }
}
```

Now every time you soft delete a user, all of its posts will also be deleted.

Some notes:
* It's a good idea to wrap the delete call in a transaction;
* All models to be cascade delete must use SoftDelete or CascadeSoftDelete;
* If you forceDelete, there will be no cascading. Use standard DB functionality for that;
* It doesn't do cascade restore. But since all models are saved with the same deleted_at time
you can query the database and restore those items based on the deleted_at value. (will be done in next version)

## HasModelDisplayName

Adds the getModelDisplayName() function.

The default name is the class name. Example: class "ArticlePost"; display name "Article Post".

You can override the name by using a variable named modelDisplayName.

```php
class ArticlePost
{
    protected $modelDisplayName = 'Magazine Post';
}
```

## HasOrder

Creates a scope that orders by based on what you have set on a variable called hasOrder.

```php
use Ggmm\Model\HasOrder;

class Post extends Model {
    use HasOrder;

    protected $hasOrder = ['created_at' => 'desc', 'title'];
}

//You can then do things like
Post::ordered()->get();
```
