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

namespace Webuntis\Models;

use Webuntis\Models\Interfaces\CachableModelInterface;


/**
 * Class Schoolyears
 * @package Webuntis\Models
 * @author Tobias Franek <tobias.franek@gmail.com>
 */
class Schoolyear extends AbstractModel implements CachableModelInterface {
    /**
     * @var string
     */
    private $name;
    /**
     * @var \DateTime
     */
    private $startDate;
    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var int
     */
    const CACHE_LIFE_TIME = 86400;

    /**
     * @var string
     */
    const METHOD = 'getCurrentSchoolyear';

    /**
     * parses the given data from the json rpc api to the right format for the object
     * @param $data array
     */
    public function parse($data) {
        $this->setId($data['id']);
        $this->name = $data['name'];
        $this->startDate = new \DateTime($data['startDate']);
        $this->endDate = new \DateTime($data['endDate']);
    }

    /**
     * serializes the object and returns an array with the objects values
     * @return array
     */
    public function serialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->name,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ];
    }

    /**
     * sets name
     * @param $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * return the name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * set the startDate
     * @param \DateTime $startDate
     * @return $this
     */
    public function setStartDate(\DateTime $startDate) {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * return the startDate
     * @return \DateTime
     */
    public function getStartDate() {
        return $this->startDate;
    }

    /**
     * sets the endDate
     * @param \DateTime $endDate
     * @return $this
     */
    public function setEndDate(\DateTime $endDate) {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * returns the endDate
     * @return \DateTime
     */
    public function getEndDate() {
        return $this->endDate;
    }
}