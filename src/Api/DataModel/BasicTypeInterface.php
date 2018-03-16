<?php

namespace ConnectID\Api\DataModel;


interface BasicTypeInterface {

  public function getId(): string;

  public function toArray(): array;
}
