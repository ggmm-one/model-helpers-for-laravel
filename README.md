# Model Helpers for Laravel

A set of helpers for building Laravel apps even faster:

* [CascadeSoftDeletes](cascadesofdeletes) - emulates sql cascade on delete for SoftDelete models

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