<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
     * Fetch projects filtered by type in order of order.
     * 
     * @param ?string $type
     * @return Collection
     */
    public function getProjectsInOrder(?string $type = ''): Collection
    {
        $query = Project::orderBy('order', 'DESC')->where('is_active', true)->ofType($type);
        return $query->get();
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
        $lastOrder = Project::where('type', $data['type'])->max('order') ?? 0;
        $data['order'] = $lastOrder + 1;
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
     * Update the project order.
     * 
     * @param int $projectId
     * @param int $newOrder
     * @return Project
     */
    public function updateProjectOrder(int $projectId, int $newOrder): Project
    {
        $project = Project::findOrFail($projectId);
        $project->order = $newOrder;
        $project->save();
        return $project;
    }

    /**
     * Decrement all projects order after a specified order.
     * 
     * @param string $type
     * @param int $order
     * @return int
     */
    private function decrementProjectsOrderAfter(string $type, int $order): int
    {
        return Project::where('type', $type)
            ->where('order', '>', $order)
            ->decrement('order');
    }

    /**
     * Toggle the project active status.
     * 
     * @param int $projectId
     * @return Project
     */
    public function toggleProjectStatus(int $projectId): Project
    {
        return DB::transaction(function () use ($projectId) {
            $project = Project::findOrFail($projectId);
            $this->decrementProjectsOrderAfter($project->type, $project->order);
            $project->is_active = !$project->is_active;
            $project->order = 0;
            $project->save();
            return $project;
        });
    }

    /**
     * Delete the project (soft delete).
     * 
     * @param int $projectId
     * @return Project
     */
    public function deleteProject(int $projectId): Project
    {
        return DB::transaction(function () use ($projectId) {
            $project = Project::findOrFail($projectId);
            $this->decrementProjectsOrderAfter($project->type, $project->order);
            $project->order = 0;
            $project->save();
            $project->delete();
            return $project;
        });
    }
}
