<div class="mb-8">
    <div class="flex items-center justify-center">
        <div class="flex items-center w-2/3">
            <button type="button" class="step-button {{ $currentStep == 1 ? 'active' : '' }}" data-step="1">
                <span class="step-circle">1</span>
                <span class="step-text">Basics</span>
            </button>
            <div class="step-line"></div>
            <button type="button" class="step-button {{ $currentStep == 2 ? 'active' : '' }}" data-step="2">
                <span class="step-circle">2</span>
                <span class="step-text">Curriculum</span>
            </button>
            <div class="step-line"></div>
            <button type="button" class="step-button {{ $currentStep == 3 ? 'active' : '' }}" data-step="3">
                <span class="step-circle">3</span>
                <span class="step-text">Additional</span>
            </button>
        </div>
    </div>
</div> 