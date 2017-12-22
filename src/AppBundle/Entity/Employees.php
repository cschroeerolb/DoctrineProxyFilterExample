<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employees
 *
 * @ORM\Table(name="employees")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeesRepository")
 */
class Employees
{

    /**
     *
     * @var int @ORM\Column(name="EMPLOYEE_ID", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="FIRST_NAME", type="string", length=20)
     */
    private $firstName;

    /**
     *
     * @var string @ORM\Column(name="LAST_NAME", type="string", length=25, nullable=true)
     */
    private $lastName;

    /**
     *
     * @var string @ORM\Column(name="SALARY", type="decimal", precision=8, scale=2)
     */
    private $salary;

    /**
     *
     * @var Departments @ORM\ManyToOne(targetEntity="AppBundle\Entity\Departments",
     *      fetch="LAZY", inversedBy="employees")
     *      @ORM\JoinColumn(name="DEPARTMENT_ID",
     *      referencedColumnName="DEPARTMENT_ID")
     */
    private $department;

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
     * Set firstName
     *
     * @param string $firstName            
     *
     * @return Employees
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName            
     *
     * @return Employees
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set salary
     *
     * @param string $salary            
     *
     * @return Employees
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
        
        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     *
     * @return Departments $department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     *
     * @param \AppBundle\Entity\Departments $department            
     */
    public function setDepartment(Departments $department)
    {
        $this->department = $department;
    }
}

