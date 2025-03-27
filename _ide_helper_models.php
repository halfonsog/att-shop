<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property string $usr_id
 * @property string $usr_pwd
 * @property string|null $usr_type
 * @property int|null $ent_id
 * @property string|null $rep
 * @property string|null $psw_hint
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEntId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePswHint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRep($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsrPwd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsrType($value)
 */
	class User extends \Eloquent {}
}

