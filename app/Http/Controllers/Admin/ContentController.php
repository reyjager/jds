<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioProject;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function services(): View
    {
        return view('admin.content.services.index', ['items' => Service::orderBy('sort_order')->orderBy('name')->get(), 'trashedItems' => Service::onlyTrashed()->orderBy('name')->get()]);
    }

    public function createService(): View
    {
        return view('admin.content.services.form', ['item' => new Service(), 'action' => route('admin.services.store')]);
    }

    public function storeService(Request $request): RedirectResponse
    {
        $data = $this->serviceData($request);
        Service::create($data);
        return redirect()->route('admin.services')->with('success', 'Service created.');
    }

    public function editService(Service $service): View
    {
        return view('admin.content.services.form', ['item' => $service, 'action' => route('admin.services.update', $service)]);
    }

    public function updateService(Request $request, Service $service): RedirectResponse
    {
        $service->update($this->serviceData($request, $service));
        return redirect()->route('admin.services')->with('success', 'Service updated.');
    }

    public function destroyService(Service $service): RedirectResponse
    {
        $service->delete();
        return back()->with('success', 'Service deleted.');
    }

    public function restoreService(int $service): RedirectResponse
    {
        Service::onlyTrashed()->findOrFail($service)->restore();
        return back()->with('success', 'Service restored.');
    }

    public function portfolio(): View
    {
        return view('admin.content.portfolio.index', ['items' => PortfolioProject::orderBy('sort_order')->orderBy('title')->get(), 'trashedItems' => PortfolioProject::onlyTrashed()->orderBy('title')->get()]);
    }

    public function createPortfolio(): View
    {
        return view('admin.content.portfolio.form', ['item' => new PortfolioProject(), 'action' => route('admin.portfolio.store')]);
    }

    public function storePortfolio(Request $request): RedirectResponse
    {
        PortfolioProject::create($this->portfolioData($request));
        return redirect()->route('admin.portfolio')->with('success', 'Portfolio project created.');
    }

    public function editPortfolio(PortfolioProject $portfolioProject): View
    {
        return view('admin.content.portfolio.form', ['item' => $portfolioProject, 'action' => route('admin.portfolio.update', $portfolioProject)]);
    }

    public function updatePortfolio(Request $request, PortfolioProject $portfolioProject): RedirectResponse
    {
        $portfolioProject->update($this->portfolioData($request, $portfolioProject));
        return redirect()->route('admin.portfolio')->with('success', 'Portfolio project updated.');
    }

    public function destroyPortfolio(PortfolioProject $portfolioProject): RedirectResponse
    {
        $portfolioProject->delete();
        return back()->with('success', 'Portfolio project deleted.');
    }

    public function restorePortfolio(int $portfolioProject): RedirectResponse
    {
        PortfolioProject::onlyTrashed()->findOrFail($portfolioProject)->restore();
        return back()->with('success', 'Portfolio project restored.');
    }

    public function team(): View
    {
        return view('admin.content.team.index', ['items' => TeamMember::orderBy('sort_order')->orderBy('name')->get(), 'trashedItems' => TeamMember::onlyTrashed()->orderBy('name')->get()]);
    }

    public function createTeam(): View
    {
        return view('admin.content.team.form', ['item' => new TeamMember(), 'action' => route('admin.team.store')]);
    }

    public function storeTeam(Request $request): RedirectResponse
    {
        TeamMember::create($this->teamData($request));
        return redirect()->route('admin.team')->with('success', 'Team member created.');
    }

    public function editTeam(TeamMember $teamMember): View
    {
        return view('admin.content.team.form', ['item' => $teamMember, 'action' => route('admin.team.update', $teamMember)]);
    }

    public function updateTeam(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $data = $this->teamData($request, $teamMember);
        if ($request->hasFile('photo')) {
            $this->deleteLocalImage($teamMember->photo);
        }
        $teamMember->update($data);
        return redirect()->route('admin.team')->with('success', 'Team member updated.');
    }

    public function destroyTeam(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->delete();
        return back()->with('success', 'Team member deleted.');
    }

    public function restoreTeam(int $teamMember): RedirectResponse
    {
        TeamMember::onlyTrashed()->findOrFail($teamMember)->restore();
        return back()->with('success', 'Team member restored.');
    }

    private function serviceData(Request $request, ?Service $service = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'features' => ['nullable', 'string'],
            'image' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['features'] = $data['features'] ? array_values(array_filter(array_map('trim', explode("\n", $data['features']))) ) : [];
        $data['published'] = $request->boolean('published');
        return $data;
    }

    private function portfolioData(Request $request, ?PortfolioProject $project = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'url', 'max:2048'],
            'project_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['published'] = $request->boolean('published');
        return $data;
    }

    private function teamData(Request $request, ?TeamMember $teamMember = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate(['photo' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048']]);
            $data['photo'] = $request->file('photo')->store('team', 'public');
        } elseif ($request->filled('photo')) {
            $data['photo'] = $request->validate(['photo' => ['url', 'max:2048']])['photo'];
        } elseif ($teamMember === null) {
            $data['photo'] = null;
        }

        return $data + ['published' => $request->boolean('published')];
    }

    private function deleteLocalImage(?string $path): void
    {
        if ($path !== null && ! str_starts_with($path, 'http://') && ! str_starts_with($path, 'https://')) {
            Storage::disk('public')->delete($path);
        }
    }
}
