<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException as QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\iSocialCard;
use App\Observers\SocialCardObserver;

class SocialCardBase extends Model implements iSocialCard
{

  /****************************************************************************/

  use SoftDeletes;

  /****************************************************************************/

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  ];

  /****************************************************************************/

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  /****************************************************************************/

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  public $appends = [
    'card_type',
    'card_vue_id'
  ];

    
  /** VIRTUAL ATTRIBUTES ******************************************************/

  public $card_type   = 'social_card';
  public $card_vue_id = null;

  /** EVENTS ******************************************************************/

  /**
   * The event map for the model.
   *
   * @var array
   */
  protected $dispatchesEvents = [
    'created' => SocialCardObserver::class,
    'saved'   => SocialCardObserver::class
  ];

  /** RELATIONSHIPS ***********************************************************/

  public function hashtag_lookups ()
  {
    return( $this->belongsTo( 'App\SocialCardHashtagLookup', 'card_id' ) );
  }

  /** ---------------------------------------------------------------------- **/

  public function social_cards ()
  {
    return( $this->morphMany( 'App\SocialCardLookup', 'social_card' ) );
  }

  /** MUTATORS ****************************************************************/

  // NONE

  /** ACCESSORS ***************************************************************/

  public function getCardTypeAttribute ()
  {
    return( $this->card_type );
  }

  /** ---------------------------------------------------------------------- **/

  public function getCardVueIdAttribute ()
  {
    $this->card_vue_id = $this->card_type . '_' . $this->id;
    return( $this->card_vue_id );
  }

  /** MUTATORS ****************************************************************/

  public function setLangAttribute ( $value )
  {
    $this->attributes['lang'] = substr( $value, 0, 8 ); // Column is 8 chars wide
  }

  /** APPROVED ****************************************************************/

  public function SetApproved ( Bool $approved )
  {
    $this->save();
    foreach( $this->social_cards as $social_card )
    {
      $social_card->approved = $approved;
      $social_card->save();
    }
  }

  /** ---------------------------------------------------------------------- **/

  public function GetApproved ()
  {
    if( count( $this->social_cards ) > 0 )
    {
      $this->approved = $this->social_cards->first()->approved;
    }
    return( $this->approved );
  }

  /** FEATURED ****************************************************************/

  public function SetFeatured ( Bool $featured )
  {
    $this->save();
    foreach( $this->social_cards as $social_card )
    {
      $social_card->featured = $featured;
      $social_card->save();
    }
  }

  /** ---------------------------------------------------------------------- **/

  public function GetFeatured ()
  {
    if( count( $this->social_cards ) > 0 )
    {
      $this->featured = $this->social_cards->first()->featured;
    }
    return( $this->featured );
  }


  /** HASHTAGS ****************************************************************/

  public function AddHashtags ( $tags )
  {
    foreach( $this->social_cards as $social_card )
    {
      $social_card->AddHashtags( $tags );
    }
  }

  /** ---------------------------------------------------------------------- **/

  public function RemoveHashtags ()
  {
    foreach( $this->social_cards as $social_card )
    {
      $social_card->RemoveHashtags( $tags );
    }
  }

  /** ---------------------------------------------------------------------- **/

  public function GetHashtags ()
  {
    $hashtags = array();
    foreach( $this->social_cards as $social_card )
    {
      $hashtags = array_merge( $hashtags, $this->social_card->hashtags );
    }
    $hashtags = array_unique( $hashtags );
    return( $hashtags );
  }

  /****************************************************************************/

}
