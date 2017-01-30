<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','firstname','lastname','location','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName(){
        if($this->attributes['firstname'] && $this->attributes['lastname']){
            return "{$this->attributes['firstname']}"." {$this->attributes['lastname']}";
        }
        else if($this->attributes['firstname'])
            return "{$this->attributes['firstname']}";
        else if($this->attributes['lastname'])
            return "{$this->attributes['lastname']}";
        else
            return "{$this->attributes['name']}";

    }
    public function friendsOfUser(){
        return $this->belongsToMany('App\User','friends','user_id','friend_id');
    }

    public function friendsOfFriend(){
        return $this->belongsToMany('App\User','friends','friend_id','user_id');
    }

    public function friends(){
        return $this->friendsOfUser()->wherePivot('accepted',true)->get()->
        merge($this->friendsOfFriend()->wherePivot('accepted',true)->get());
    }

    public function friendRequests(){
        return $this->friendsOfUser()->wherePivot('accepted',false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendsOfFriend()->wherePivot('accepted',false)->get();
    }
    public function hasFriendRequestPending($user){
        return (bool) $this->friendRequestsPending()->where('id',$user->id)->count();
    }
    public function hasFriendRequestReceived($user){
        return (bool) $this->friendRequests()->where('id',$user->id)->count();
    }
    public function addFriend(User $user){
        $this->friendsOfFriend()->attach($user->id);
    }
    public function acceptFriendRequest(User $user){
        $this->friendRequests()->where('id',$user->id)->first()->pivot->update([
                'accepted' => true,
            ]);
    }

    public function isFriendWith($user){
        return (bool) $this->friends()->where('id',$user->id)->count();
    }

    public function statuses(){
        return $this->hasMany('App\Status');
    }

    public function albums(){
        return $this->hasMany('App\Album');
    }

}
