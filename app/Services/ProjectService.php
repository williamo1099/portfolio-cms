<?php

namespace App\Services;

use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Log;

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
     */
    public function getProjectCount(): array
    {
        try {
            return Project::selectRaw('type, COUNT(*) AS total')
                ->groupBy('type')
                ->pluck('total', 'type')
                ->toArray();
        } catch (Exception $ex) {
            Log::error('Error fetching project count', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            return [];
        }
    }

    /**
     * Create a new project.
     * 
     * @param array $data
     */
    public function createProject(array $data): bool
    {
        try {
            $data['stacks'] = json_encode(array_map('trim', explode(',', $data['stacks'])));
            Project::create($data);
            return true;
        } catch (Exception $ex) {
            Log::error('Error creating project', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Update the project.
     * 
     * @param int $projectId
     * @param array $data
     */
    public function updateProject(int $projectId, array $data): bool
    {
        try {
            $project = Project::findOrFail($projectId);
            $data['stacks'] = json_encode(array_map('trim', explode(',', $data['stacks'])));
            return $project->update($data);
        } catch (Exception $ex) {
            Log::error('Error updating project', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Toggle the project active status.
     * 
     * @param int $projectId
     */
    public function toggleProjectStatus(int $projectId): bool
    {
        try {
            $project = Project::findOrFail($projectId);
            $project->is_active = !$project->is_active;
            return $project->save();
        } catch (Exception $ex) {
            Log::error('Error toggling project status', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Delete the project (soft delete).
     * 
     * @param int $projectId
     */
    public function deleteProject(int $projectId): bool
    {
        try {
            $project = Project::findOrFail($projectId);
            return $project->delete();
        } catch (Exception $ex) {
            Log::error('Error deleting project', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return false;
        }
    }
}
