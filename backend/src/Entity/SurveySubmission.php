<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="App\Repository\SurveySubmissionRepository")
 */
class SurveySubmission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Serializer\Expose
     * @ORM\Column(type="guid")
     */
    private $uuid;

    /**
     * @Serializer\Expose
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Serializer\Expose
     * @ORM\Column(type="boolean")
     */
    private $submitted;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Survey", inversedBy="submissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $survey;

    /**
     * @Serializer\Expose
     * @ORM\OneToMany(targetEntity="App\Entity\SurveySubmissionImage", mappedBy="submission")
     */
    private $images;

    /**
     * @Serializer\Expose
     * @ORM\OneToMany(targetEntity="App\Entity\SurveySubmissionPractiseImage", mappedBy="submission")
     */
    private $practise_images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->practise_images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSubmitted(): ?bool
    {
        return $this->submitted;
    }

    public function setSubmitted(bool $submitted): self
    {
        $this->submitted = $submitted;

        return $this;
    }

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function setSurvey(?Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * @return Collection|SurveySubmissionImage[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(SurveySubmissionImage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setSubmission($this);
        }

        return $this;
    }

    public function removeImage(SurveySubmissionImage $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getSubmission() === $this) {
                $image->setSubmission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SurveySubmissionPractiseImage[]
     */
    public function getPractiseImages(): Collection
    {
        return $this->practise_images;
    }

    public function addPractiseImage(SurveySubmissionPractiseImage $practiseImage): self
    {
        if (!$this->practise_images->contains($practiseImage)) {
            $this->practise_images[] = $practiseImage;
        }

        return $this;
    }

    public function removePractiseImage(SurveySubmissionPractiseImage $practiseImage): self
    {
        if ($this->practise_images->contains($practiseImage)) {
            $this->practise_images->removeElement($practiseImage);
        }

        return $this;
    }
}
