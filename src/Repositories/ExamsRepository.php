<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Webuntis\Repositories;

use Doctrine\Common\Cache\ApcuCache;
use Webuntis\Models\Exams;
use Webuntis\Models\ExamTypes;
use Webuntis\Query\Query;
use Webuntis\Util\ExecutionHandler;

/**
 * Class ExamsRepository
 * @package Webuntis\Repositories
 * @author Tobias Franek <tobias.franek@gmail.com>
 */
class ExamsRepository extends Repository {
    public function findAll() {
        $cache = new ApcuCache();
        if ($cache->contains('Exams')) {
            $exams = $cache->fetch('Exams');
        } else {
            $query = new Query();
            $examTypes = ExecutionHandler::execute(ExamTypes::class, $this->instance, []);

            $exams = [];
            $schoolyear = $query->get('schoolyear')->findAll();
            foreach ($examTypes as $value) {
                $exams[] = ExecutionHandler::execute(Exams::class, $this->instance, ['examTypeId' => $value['type'], 'startDate' => date_format($schoolyear->getStartDate(), 'Ymd'), 'endDate' => date_format($schoolyear->getEndDate(), 'Ymd')]);
            }
            $cache->save('Exams', $exams, 604800);
        }

        return $this->parse($exams);
    }
}