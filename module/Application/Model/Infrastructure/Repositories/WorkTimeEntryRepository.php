<?php

namespace Application\Model\Infrastructure\Repositories;

use Application\Library\BaseRepository;

class WorkTimeEntryRepository extends BaseRepository 
{
    public function getWorkTimeEntriesForIssue($issue, $filterFrom = null, $filterTo = null)
    {
        $dql = 'SELECT wte, ae, u FROM \Application\Model\Domain\WorkTimeEntry wte JOIN wte.activityEntries ae JOIN ae.user u WHERE ae.issue = ?1 ORDER BY wte.entryDate DESC';
        $query = $this->getEntityManager()->createQuery($dql)
                ->setParameter(1, $issue->getId());
        return $query->getResult();
    }
}
