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

use Webuntis\Models\Interfaces\AdministrativeModelInterface;
use Webuntis\Models\Interfaces\CachableModelInterface;

/**
 * Class Teachers
 * @package Webuntis\Models
 * @author Tobias Franek <tobias.franek@gmail.com>
 */
class Teachers extends AbstractModel implements AdministrativeModelInterface, CachableModelInterface {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var int
     */
    const CACHE_LIFE_TIME = 86400;

    /**
     * @var string
     */
    const METHOD = "getTeachers";

    /**
     * return the name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * parses the given data from the json rpc api to the right format for the object
     * @param array $data
     */
    protected function parse($data) {
        $this->setId($data['id']);
        $this->firstName = $data['foreName'];
        $this->lastName = $data['longName'];
        $this->name = $data['name'];
    }

    /**
     * serializes the object and returns an array with the objects values
     * @return array
     */
    public function serialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->name,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName
        ];
    }

    /**
     * sets the name
     * @param string $name
     * @return Teachers $this
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * returns the firstName
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * sets the firstName
     * @param string $firstName
     * @return Teachers $this
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * return the lastName
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * sets the lastName
     * @param string $lastName
     * @return Teachers $this
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }
}