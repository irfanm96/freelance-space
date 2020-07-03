<p>Project : {{$project->name}}</p>
<p>Owner : {{optional($project->team->owner)->name}} </p>
<p>Email : {{optional($project->team->owner)->email}} </p>
