<?php

use Godruoyi\Snowflake\Snowflake;

function snowflake() {$snowflake = new Snowflake(); return $snowflake -> id();};