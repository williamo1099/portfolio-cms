<?php

namespace App\Services;

use App\Models\CurriculumVitae;
use Illuminate\Support\Collection;

class CurriculumVitaeService
{
    /**
     * Fetch curriculum vitaes.
     * 
     * @return Collection
     */
    public function getCurriculumVitaes(): Collection
    {
        return CurriculumVitae::latest()->take(10)->get();
    }

    /**
     * Create a new curriculum vitae.
     * Before creating the new CV, deactivate all CVs.
     * 
     * @param array $data
     * @return CurriculumVitae
     */
    public function createCurriculumVitae(array $data): CurriculumVitae
    {
        CurriculumVitae::query()->update(['is_active' => 0]);
        return CurriculumVitae::create($data);
    }

    /**
     * Set the curriculum vitae status to active.
     * Before updating the CV, deactivate all CVs.
     * 
     * @param int $cvId
     * @return CurriculumVitae
     */
    public function setCurriculumVitaeStatusToActive(int $cvId): CurriculumVitae
    {
        CurriculumVitae::query()->update(['is_active' => 0]);
        $curriculumVitae = CurriculumVitae::findOrFail($cvId);
        $curriculumVitae->is_active = 1;
        $curriculumVitae->save();
        return $curriculumVitae;
    }

    /**
     * Delete the curriculum vitae (hard delete).
     * 
     * @param int $cvId
     * @return CurriculumVitae
     */
    public function deleteCurriculumVitae(int $cvId): CurriculumVitae
    {
        $curriculumVitae = CurriculumVitae::findOrFail($cvId);
        $curriculumVitae->delete();
        return $curriculumVitae;
    }
}
