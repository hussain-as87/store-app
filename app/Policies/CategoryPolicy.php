<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class CategoryPolicy
{
   use HandlesAuthorization;

   /*   public function before(User $user, $ability)
    {
        if ($user->type == 'super_admin') {
            return true;
        }
    } */

   /**
    * Determine whether the user can view any models.
    *
    * @param \App\Models\User $user
    * @return mixed
    */
   /*  public function viewAny(User $user)
    {
       return $user->hasPermission('category.view_any');
    } */

   /**
    * Determine whether the user can view the model.
    *
    * @param \App\Models\User $user
    * @param \App\Models\Category $category
    * @return mixed
    */
   /* public function view(User $user)
    {
       return $user->hasPermission('category.view');

    } */

   /**
    * Determine whether the user can create models.
    *
    * @param \App\Models\User $user
    * @return mixed
    */
   /*  public function create(User $user)
    {
       return $user->hasPermission('category.create');

    } */

   /**
    * Determine whether the user can update the model.
    *
    * @param \App\Models\User $user
    * @param \App\Models\Category $category
    * @return mixed
    */
   /*  public function update(User $user)
    {
       
       return $user->hasPermission('category.update');

    } */

   /**
    * Determine whether the user can delete the model.
    *
    * @param \App\Models\User $user
    * @param \App\Models\Category $category
    * @return mixed
    */
   /*     public function delete(User $user)
    {
       return $user->hasPermission('category.delete');

    } */

   /**
    * Determine whether the user can restore the model.
    *
    * @param \App\Models\User $user
    * @param \App\Models\Category $category
    * @return mixed
    */
   /*   public function restore(User $user)
    {
      return  $user->hasPermission('category.restore');

    } */

   /**
    * Determine whether the user can permanently delete the model.
    *
    * @param \App\Models\User $user
    * @param \App\Models\Category $category
    * @return mixed
    */
   /*    public function forceDelete(User $user)
    {
      return  $user->hasPermission('category.force_delete');

    } */

   /**
    * Determine whether the user can permanently delete the model.
    *
    * @param \App\Models\User $user
    * @param \App\Models\Category $Category
    * @return mixed
    */
   /*   public function images(User $user)
    {
       return $user->hasPermission('category.image');
    } */
}
