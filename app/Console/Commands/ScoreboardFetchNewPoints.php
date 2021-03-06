<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

use App\Fetchers\ScoreboardPointsFetch;

class ScoreboardFetchNewPoints extends Command
{

  /****************************************************************************/

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'ot-scoreboard:fetch-new-points';

  /****************************************************************************/

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Fetch new points from AppWorks.';

  /****************************************************************************/

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct ()
  {
    parent::__construct ();
  }

  /****************************************************************************/

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle ()
  {

    $fetcher = new ScoreboardPointsFetch( true );
    $results = array();
    $dirty   = false;

    array_push( $results, $fetcher->FetchPoints() );

    foreach( $results as $result )
    {
      if( $result == true )
      {
        $dirty = true;
      }
    }

    if( $dirty )
    {
      $fetcher->RecalculateTeamScores();
      Cache::tags( [ 'Scoreboard' ] )->flush();
    }

  }

  /****************************************************************************/

}
