<?php
// entities/ABS102S1.php
/**
 * @Entity @Table(name="ABS102S1")
 **/
use Doctrine\ORM\Mapping as ORM;
class ABS102S1
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $JSRQ_T;
    /** @Column(type="string") **/
    protected $KSRQ_T;

    // .. (other code)
}