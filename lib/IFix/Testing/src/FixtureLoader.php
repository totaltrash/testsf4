<?php

namespace IFix\Testing;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

/**
 * Fixture loader.
 *
 * Helper methods to reset database state
 */
class FixtureLoader
{
    /**
     * Constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Reset the database state - purge all ORM tables and reset
     * the sequences.
     *
     * @param sting[] $sequences The names of the sequences to reset
     */
    public function resetDatabase(array $sequences = array(), array $exclusions = array())
    {
        $this->purgeDatabase($exclusions);
        $this->resetSequences($sequences);
    }

    /**
     * Purge the ORM tables in the database.
     */
    public function purgeDatabase(array $exclusions = array())
    {
        $purger = new ORMPurger($this->entityManager, $exclusions);
        $purger->purge();
    }

    /**
     * Reset a sequence.
     *
     * @param sting $sequenceName The name of the sequence to reset
     * @param int   $next         The next number to use in the sequence
     *
     * @return DataContext
     */
    public function resetSequence($sequenceName, $next = 1)
    {
        $rsm = new ResultSetMapping();
        $this->entityManager->createNativeQuery("ALTER SEQUENCE $sequenceName RESTART $next", $rsm)->execute();

        return $this;
    }

    /**
     * Reset an array of sequences.
     *
     * @param sting[] $sequences The names of the sequences to reset
     * @param int     $next      The next number to use in the sequence
     */
    public function resetSequences(array $sequences = array(), $next = 1)
    {
        foreach ($sequences as $sequence) {
            $this->resetSequence($sequence, $next);
        }
    }

    /**
     * Reset a table.
     *
     * @param sting $tableName The name of the table to reset
     *
     * @return FixtureLoader
     */
    public function resetTable($tableName)
    {
        $rsm = new ResultSetMapping();
        $this->entityManager->createNativeQuery("TRUNCATE $tableName CASCADE", $rsm)->execute();
        
        return $this;
    }

    /**
     * Reset an array of tables.
     *
     * @param sting[] $tables   The names of the tables to reset
     */
    public function resetTables(array $tables = array())
    {
        foreach ($tables as $table) {
            $this->resetTable($table);
        }
    }

    /**
     * Persist an entity.
     *
     * @param mixed $item  The item to persist
     * @param bool  $clear Clear the entity manager?
     */
    public function persistEntity($item, $clear = true)
    {
        $this->entityManager->persist($item);
        $this->entityManager->flush();

        if ($clear === true) {
            $this->entityManager->clear();
        }
    }

    /**
     * Persist an array of entities.
     *
     * @param mixed[] $item              An array of items to persist
     * @param bool    $clear             Clear the entity manager?
     * @param bool    $clearOnEachEntity Clear the entity manager after flushing each entity?
     */
    public function persistEntities(array $entities = array(), $clear = true, $clearOnEachEntity = false)
    {
        foreach ($entities as $entity) {
            $this->persistEntity($entity, $clearOnEachEntity);
        }

        $this->entityManager->flush();

        if ($clear === true) {
            $this->entityManager->clear();
        }
    }
}
