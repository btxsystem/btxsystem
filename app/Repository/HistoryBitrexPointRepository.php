<?php

namespace App\Repositories;

use App\HistoryBitrexPoints as Model;

class HistoryBitrexPointRepository
{

  /**
   * save function
   *
   * @param [type] $builder
   * @return void
   */
  public function save($builder)
  {
    $save = Model::insertGetId([
      'id_member' => $builder->getIdMember(),
      'nominal' => $builder->getNominal(),
      'points' => $builder->getPoints(),
      'description' => $builder->getDescription(),
      'info' => $builder->getInfo(),
      'transaction_ref' => $builder->getTransactionRef(),
      'status' => $builder->getStatus(),
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
    ]);

    if(!$save) return false;

    return true;
  }

  /**
   * update function
   *
   * @param [type] $builder
   * @return void
   */
  public function update($builder)
  {
    $update = Model::where('id', $builder->getId())
    ->update([
      'id_member' => $builder->getIdMember(),
      'nominal' => $builder->getNominal(),
      'points' => $builder->getPoints(),
      'description' => $builder->getDescription(),
      'info' => $builder->getInfo(),
      'transaction_ref' => $builder->getTransactionRef(),
      'status' => $builder->getStatus(),
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
    ]);

    if(!$update) return false;

    return true;
  }

}