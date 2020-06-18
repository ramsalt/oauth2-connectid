<?php

namespace ConnectID\Api\DataModel;


abstract class BasicType extends BasicData implements BasicTypeInterface {

  public const PERIOD_DAY = 'days';

  public const PERIOD_WEEK = 'weeks';

  public const PERIOD_MONTH = 'months';

  public const PERIOD_YEAR = 'years';

}
