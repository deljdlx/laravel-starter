<div>
    <h3 class="card-title">Node.js Version</h3>
    <p class="card-subtitle">
      The version of Node.js that is used in the Build Step and for Serverless
      Functions. A new Deployment is required for your changes to take
      effect.
    </p>
    <x-select-input 
        name="nodejs_version" 
        :options="['14.x' => '14.x', '12.x' => '12.x']" 
    />
</div>
