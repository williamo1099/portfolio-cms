<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    /**
     * Fetch projects filtered by type and ordered by newest first
     * 
     * @param ?string $type
     * @param ?int $perPage
     */
    public function getProjects(?string $type = '', ?int $perPage = null)
    {
        $query = Project::latest()->ofType($type);
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Count the number of projects by type.
     * 
     * @return array
     */
    public function getProjectCount(): array
    {
        return Project::selectRaw('type, COUNT(*) AS total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();
    }

    /**
     * Create a new project.
     * 
     * @param array $data
     * @return Project
     */
    public function createProject(array $data): Project
    {
        $data['stacks'] = json_encode(array_map('trim', explode(',', $data['stacks'])));
        return Project::create($data);
    }

    /**
     * Update the project.
     * 
     * @param int $projectId
     * @param array $data
     * @return Project
     */
    public function updateProject(int $projectId, array $data): Project
    {
        $project = Project::findOrFail($projectId);
        $data['stacks'] = json_encode(array_map('trim', explode(',', $data['stacks'])));
        $project->update($data);
        return $project;
    }

    /**
     * Toggle the project active status.
     * 
     * @param int $projectId
     * @return Project
     */
    public function toggleProjectStatus(int $projectId): Project
    {
        $project = Project::findOrFail($projectId);
        $project->is_active = !$project->is_active;
        $project->save();
        return $project;
    }

    /**
     * Delete the project (soft delete).
     * 
     * @param int $projectId
     * @return Project
     */
    public function deleteProject(int $projectId): Project
    {
        $project = Project::findOrFail($projectId);
        $project->delete();
        return $project;
    }
}
