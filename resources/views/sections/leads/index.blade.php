@extends('indigo-layout::main')

@section('meta_title', _p('pages.leads.meta_title', 'meta_title') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.leads.meta_description', 'meta_description'))

@push('head')
@endpush

@section('create_button')
    <button class="frame__header-add" @click="AWES.emit('modal::leads:open')"><i class="icon icon-plus"></i></button>
@endsection

@section('content')
    <div class="filter">
        <div class="grid grid-align-center grid-justify-between grid-justify-center--mlg">
            <div class="cell-inline cell-1-1--mlg">
                <div class="grid grid-ungap">
                    <div class="cell-inline cell-1-1--mlg">
                        @filtergroup(['filter' => ['' => 'All', 'new' => 'New', 'closed' => 'Closed'], 'variable' => 'status'])
                    </div>
                </div>
            </div>
            <div class="cell-inline">
                <div class="filter__rlink">
                    <context-menu button-class="filter__slink" right>
                        <template slot="toggler">
                            <span>{{  _p('pages.filter.sort_by', 'Sort by') }}</span>
                        </template>
                        <cm-query :param="{orderBy: 'name'}">{{ _p('pages.leads.filter.name', 'Name') }} &darr;</cm-query>
                        <cm-query :param="{orderBy: 'name_desc'}">{{ _p('pages.leads.filter.name', 'Name') }} &uarr;</cm-query>
                        <cm-query :param="{orderBy: 'status'}">{{ _p('pages.leads.filter.status', 'Status') }} &darr;</cm-query>
                        <cm-query :param="{orderBy: 'status_desc'}">{{ _p('pages.leads.filter.status', 'Status') }} &uarr;</cm-query>
                    </context-menu>
                </div>
                <div class="filter__rlink">
                    <button class="filter__slink" @click="$refs.filter.toggle()">
                        <i class="icon icon-filter" v-if="">
                            <span class="icn-dot" v-if="$awesFilters.state.active['leads']"></span>
                        </i>
                        {{  _p('pages.filter.title', 'Filter') }}
                    </button>
                </div>
            </div>
            <slide-up-down ref="filter">
                <filter-wrapper name="leads">
                    <div class="grid grid-gap-x grid_forms">
                        <div class="cell">
                            <fb-input name="name" label="{{ _p('pages.leads.filter.name', 'Name') }}"></fb-input>
                            <fb-input name="status" label="{{ _p('pages.leads.filter.name', 'Status') }}"></fb-input>
                        </div>
                    </div>
                </filter-wrapper>
            </slide-up-down>
        </div>
    </div>

    @table([
        'name' => 'leads',
        'row_url' => route('leads.index') . '/{id}',
        'scope_api_url' => route('leads.scope'),
        'scope_api_params' => ['orderBy', 'is_public', 'name', 'status'],
        'default_data' => $leads
    ])
            @slot('emptyCard')
                <a href="#modal_form" @click="AWES.emit('modal::leads:open')" class="btn mt-20">Create</a>
            @endslot

            @slot('mobile')
                <p>{{ _p('pages.leads.table.mobile.updated', 'Last update') }}: @{{ m.data.updated }}</p>
            @endslot

            <tb-column name="name" label="{{ _p('pages.leads.table.col.name', 'Name') }}"></tb-column>
            <tb-column name="status" label="{{ _p('pages.leads.table.col.status', 'Status') }}"sort></tb-column>
            <tb-column name="">
                <template slot-scope="d">
                        <context-menu right boundary="table">
                            <cm-button @click="AWES._store.commit('setData', {param: 'editLead', data: d.data}); AWES.emit('modal::edit-lead:open')">
                                {{ _p('pages.leads.table.options.edit', 'Edit') }}
                            </cm-button>
                        </context-menu>
                    </template>
                </tb-column>

    @endtable
@endsection

@section('modals')
    {{--Modal windows--}}
    <modal-window name="leads" class="modal_formbuilder" title="Create">
        <form-builder url="{{ route('leads.store') }}" :disabled-dialog="true" @sended="AWES.emit('content::leads:update')">
            <fb-input name="name" label="{{ _p('pages.leads.modal_add.name', 'Name') }}"></fb-input>
            <fb-input name="status" label="{{ _p('pages.leads.modal_add.status', 'Status') }}"></fb-input>
        </form-builder>
    </modal-window>

    <modal-window name="edit-lead" class="modal_formbuilder" title="{{ _p('pages.leads.modal.edit_lead.title', 'Edit lead') }}">
    <form-builder method="PATCH" url="/leads/{id}" store-data="editLead" @sended="AWES.emit('content::leads:update')">
        <fb-input name="name" label="{{ _p('pages.leads.modal_add.name', 'Name') }}"></fb-input>
        <fb-input name="status" label="{{ _p('pages.leads.modal_add.status', 'Status') }}"></fb-input>
    </form-builder>
</modal-window>
@endsection
