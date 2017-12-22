<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Departments
 *
 * @ORM\Table(name="departments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepartmentsRepository")
 */
class Departments
{

    /**
     *
     * @var int @ORM\Column(name="DEPARTMENT_ID", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="DEPARTMENT_NAME", type="string", length=30)
     */
    private $departmentName;

    /**
     *
     * @var Collection|Employees @ORM\OneToMany(targetEntity="AppBundle\Entity\Employees",
     *      fetch="LAZY", mappedBy="department")
     */
    private $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set departmentName
     *
     * @param string $departmentName            
     *
     * @return Departments
     */
    public function setDepartmentName($departmentName)
    {
        $this->departmentName = $departmentName;
        
        return $this;
    }

    /**
     * Get departmentName
     *
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     *
     * @return Collection|Employees $employees
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    public function addEmployee(Employees $employees)
    {
        $this->employees->add($employees);
    }
}

