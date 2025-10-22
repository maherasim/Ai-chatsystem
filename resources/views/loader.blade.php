<style>
     .skeleton {
	background: linear-gradient(90deg, #ededed, #ffffff, #ededed);
	animation-name: load;
	animation-duration: 1.5s;
	animation-iteration-count: infinite;
	animation-direction: forwards;
	animation-timing-function: linear;
	background-size: 200% 100%;
}
.skeleton.block { width: 200px; height: 20px; }
.skeleton.block.small { width: 150px; }
.skeleton.circle { width: 100px; height: 100px; border-radius: 50%; }

.loaders {
	padding: 1rem 0;
	display: flex;
	flex-direction: column;
}
.loaders > * + * { margin-top: 1rem; }

.loader {
	display: flex;
	flex-direction: row;
	background-color: #ffffff;
	padding: 1rem;
	box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
	align-items: center;
}
.loader > * + * { margin-left: 1rem; }

.skeleton-group { display: flex; flex-direction: column; }
.skeleton-group > * + * { margin-top: 1rem; }

@keyframes load {
	from { background-position: 100% 0%; }
	to   { background-position: -100% 0%; }
}

/* optional small responsive tweak */
@media (max-width: 480px) {
	.skeleton.block { width: 140px; }
	.skeleton.circle { width: 72px; height: 72px; }
}
</style>

<div class="loaders" role="status" aria-live="polite" aria-busy="true">
    
                                                    <div class="loader">
                                                        <div class="skeleton circle" aria-hidden="true"></div>
                                                        <div class="skeleton-group" style="flex:1">
                                                            <div class="skeleton block" aria-hidden="true"></div>
                                                            <div class="skeleton block" aria-hidden="true"></div>
                                                            <div class="skeleton block small" aria-hidden="true"></div>
                                                        </div>
                                                    </div>
                                                
                                            </div>