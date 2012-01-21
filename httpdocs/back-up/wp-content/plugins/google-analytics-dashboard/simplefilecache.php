<?php
/*  Copyright 2009  Carson McDonald  (carson@ioncannon.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once(dirname(__FILE__) . '/aux-lib.php');

class SimpleFileCache
{
  function isExpired($key, $expire)
  {
    $filename = sys_get_temp_dir() . '/gad_cache_' . md5($key) . '.dat';
    if(file_exists($filename)) 
    {
      return time() - filemtime($filename) > $expire;
    }
    else
    {
      return true;
    }
  }

  function cachePut($key, $value)
  {
    $lh = SimpleFileCache::lock();
    $filename = sys_get_temp_dir() . '/gad_cache_' . md5($key) . '.dat';
    if($f = @fopen($filename, "w"))
    {
      fwrite($f, serialize($value));
      fclose($f);
      SimpleFileCache::unlock($lh);
    }
  }

  function cacheGet($key)
  {
    $lh = SimpleFileCache::lock();
    $filename = sys_get_temp_dir() . '/gad_cache_' . md5($key) . '.dat';
    if($f = @fopen($filename, "r"))
    {
      $data = fread($f, filesize($filename));
      $result = unserialize($data);
      fclose($f);
      SimpleFileCache::unlock($lh);
      return $result;
    }
  }

  function lock()
  {
    $filename = sys_get_temp_dir() . '/gad_lock.dat';
    if(file_exists($filename))
    {
      $file_size = filesize($filename);
      $fp = @fopen($filename, "r+");
    }
    else
    {
      $file_size = 0;
      $fp = @fopen($filename, "w+");
    }
    if (@flock($fp, LOCK_EX)) 
    {
      $last_ts = $file_size == 0 ? time() : fread($fp, $file_size);
      fseek($fp, 0);
      if($last_ts + 360 < time())
      {
        foreach(glob(sys_get_temp_dir() . '/gad_cache_*.dat') as $filename) 
        {
          if( time() - filemtime($filename) > 360)
          {
            unlink($filename);
          }
        }
        fwrite($fp, time());
      }
      else if($file_size == 0)
      {
        fwrite($fp, $last_ts);
      }
    }
    return $fp;
  }

  function unlock($fp)
  {
    @flock($fp, LOCK_UN);
  }

}
?>
