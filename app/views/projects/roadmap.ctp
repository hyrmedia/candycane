<h2><?php __('Roadmap') ?></h2>

<?php if (count($this->data['Version']) == 0): ?>
<p class="nodata"><?php __('No data to display') ?></p>
<?php else: ?>
<div id="roadmap">
<?php foreach($this->data['Version'] as $version): ?>
    <?php echo $html->tag('a', null, array('name' => $version['name'])) ?>
    <h3 class="icon22 icon22-package"><?php echo $html->link(h($version['name']), '/versions/show/'.$version['id']) ?></h3>
    <?php echo $this->element('versions/overview', array('version' => $version)) ?>
    <%= render(:partial => "wiki/content", :locals => {:content => version.wiki_page.content}) if version.wiki_page %>
    <?php if (count($issues) > 0): ?>
    <fieldset class="related-issues"><legend><?php __('Related issues') ?></legend>
    <ul>
    <?php foreach($issues as $issue): ?>
      <li><%= link_to_issue(issue) %>: <?php echo h($issue['Issue']['subject']) ?></li>
    <?php endforeach ?>
    </ul>
    </fieldset>
    <?php endif ?>
<?php endforeach ?>
</div>
<?php endif ?>

<% content_for :sidebar do %>
<?php echo $form->create('Project', array('action'=>'roadmap', 'method'=>'get')) ?>
<h3><?php __('Roadmap') ?></h3>
<% @trackers.each do |tracker| %>
  <label><%= check_box_tag "tracker_ids[]", tracker.id, (@selected_tracker_ids.include? tracker.id.to_s), :id => nil %>
  <%= tracker.name %></label><br />
<% end %>
<br />
<label for="completed"><%= check_box_tag "completed", 1, params[:completed] %> <%= l(:label_show_completed_versions) %></label>
<p><%= submit_tag l(:button_apply), :class => 'button-small', :name => nil %></p>
<?php echo $form->end() ?>

<h3><?php __('Versions') ?></h3>
<?php foreach($this->data['Version'] as $version): ?>
<?php echo $html->link($version['name'], "#{$version['name']}") ?><br />
<?php endforeach ?>
<% end %>

<?php $candy->html_title(__('Roadmap', true)) ?>