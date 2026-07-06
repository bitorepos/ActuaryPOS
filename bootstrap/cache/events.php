<?php return array (
  'App\\Providers\\EventServiceProvider' => 
  array (
    'App\\Events\\TransactionPaymentAdded' => 
    array (
      0 => 'App\\Listeners\\AddAccountTransaction',
    ),
    'App\\Events\\TransactionPaymentUpdated' => 
    array (
      0 => 'App\\Listeners\\UpdateAccountTransaction',
    ),
    'App\\Events\\TransactionPaymentDeleted' => 
    array (
      0 => 'App\\Listeners\\DeleteAccountTransaction',
    ),
    'App\\Events\\AdvanceDepositCreatedOrModified' => 
    array (
      0 => 'App\\Listeners\\AddOrUpdateAdvanceDeposit',
    ),
    'Spatie\\Backup\\Events\\BackupWasSuccessful' => 
    array (
      0 => 'App\\Listeners\\HandleSuccessfulBackup',
    ),
    'Spatie\\Backup\\Events\\CleanupWasSuccessful' => 
    array (
      0 => 'App\\Listeners\\HandleSuccessfulCleanup',
    ),
  ),
);